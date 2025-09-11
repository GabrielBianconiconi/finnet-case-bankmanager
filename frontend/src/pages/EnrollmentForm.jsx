import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import PageLayout from '../components/PageLayout';

const EnrollmentForm = () => {
    const navigate = useNavigate();
    const [students, setStudents] = useState([]);
    const [courses, setCourses] = useState([]);
    const [selectedStudent, setSelectedStudent] = useState('');
    const [selectedCourse, setSelectedCourse] = useState('');
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const token = localStorage.getItem('token');
                
                const [studentsRes, coursesRes] = await Promise.all([
                    fetch('http://localhost:8000/api/students', {
                        headers: { 'Authorization': `Bearer ${token}` }
                    }),
                    fetch('http://localhost:8000/api/courses', {
                        headers: { 'Authorization': `Bearer ${token}` }
                    })
                ]);

                if (!studentsRes.ok || !coursesRes.ok) {
                    throw new Error('Falha ao carregar dados para o formulário.');
                }
                
                const studentsData = await studentsRes.json();
                const coursesData = await coursesRes.json();

                setStudents(studentsData.data);
                setCourses(coursesData.data);
                setLoading(false);

            } catch (err) {
                setError(err.message);
                setLoading(false);
            }
        };
        fetchData();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError(null);
        
        try {
            const token = localStorage.getItem('token');
            const response = await fetch('http://localhost:8000/api/enrollments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({ student_id: selectedStudent, course_id: selectedCourse })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'Erro ao criar a matrícula.');
            }
            
            navigate('/enrollments');

        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };
    
    if (loading) return <PageLayout pageTitle="Nova Matrícula"><div>Carregando...</div></PageLayout>;
    if (error) return <PageLayout pageTitle="Nova Matrícula"><div>Erro: {error}</div></PageLayout>;

    return (
        <PageLayout pageTitle="Nova Matrícula">
            <div className="container">
                
                {error && <div className="error-message">{error}</div>}
                
                <form onSubmit={handleSubmit} className="form">
                    <div className="form-group">
                        <label htmlFor="student">Aluno</label>
                        <select
                            id="student"
                            name="student"
                            value={selectedStudent}
                            onChange={(e) => setSelectedStudent(e.target.value)}
                            required
                        >
                            <option value="">Selecione um aluno</option>
                            {students.map(student => (
                                <option key={student.id} value={student.id}>{student.name}</option>
                            ))}
                        </select>
                    </div>
                    
                    <div className="form-group">
                        <label htmlFor="course">Curso</label>
                        <select
                            id="course"
                            name="course"
                            value={selectedCourse}
                            onChange={(e) => setSelectedCourse(e.target.value)}
                            required
                        >
                            <option value="">Selecione um curso</option>
                            {courses.map(course => (
                                <option key={course.id} value={course.id}>{course.title}</option>
                            ))}
                        </select>
                    </div>

                    <div className="form-actions">
                        <button type="submit" className="btn btn-primary" disabled={loading}>
                            {loading ? 'Salvando...' : 'Realizar Matrícula'}
                        </button>
                        
                        <a onClick={() => navigate('/enrollments')} className="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </PageLayout>
    );
};

export default EnrollmentForm;