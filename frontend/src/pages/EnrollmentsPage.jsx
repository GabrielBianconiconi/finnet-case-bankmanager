import React, { useState, useEffect } from 'react';
import PageLayout from '../components/PageLayout';
import { Link } from 'react-router-dom';

const EnrollmentsPage = () => {
    const [enrollments, setEnrollments] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const fetchEnrollments = async () => {
        try {
            const token = localStorage.getItem('token');
            const response = await fetch('http://localhost:8000/api/enrollments', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                throw new Error('Falha ao buscar as matrículas.');
            }

            const result = await response.json();
            setEnrollments(result.data);
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchEnrollments();
    }, []);

    const handleDelete = async (enrollmentId) => {
        if (!window.confirm('Tem certeza que deseja cancelar esta matrícula?')) {
            return;
        }

        try {
            const token = localStorage.getItem('token');
            const response = await fetch(`http://localhost:8000/api/enrollments/${enrollmentId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                throw new Error('Falha ao cancelar a matrícula.');
            }

            // Remove a matrícula da lista na tela
            setEnrollments(enrollments.filter(enrollment => enrollment.id !== enrollmentId));
        } catch (err) {
            setError(err.message);
        }
    };

    if (loading) return <PageLayout pageTitle="Gerenciamento de Matrículas"><div>Carregando...</div></PageLayout>;
    if (error) return <PageLayout pageTitle="Gerenciamento de Matrículas"><div>Erro: {error}</div></PageLayout>;

    return (
        <PageLayout pageTitle="Gerenciamento de Matrículas">
            <div className="container">
                <h1>Gerenciamento de Matrículas</h1>
                <Link to="/enrollments/create" className="btn btn-primary">Nova Matrícula</Link>

                <table className="table">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Curso</th>
                            <th>Data da Matrícula</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {enrollments.map(enrollment => (
                            <tr key={enrollment.id}>
                                <td>{enrollment.student_name}</td>
                                <td>{enrollment.course_title}</td>
                                <td>{new Date(enrollment.enrollment_date).toLocaleDateString('pt-BR')}</td>
                                <td>
                                    <button 
                                        onClick={() => handleDelete(enrollment.id)} 
                                        className="btn btn-danger"
                                    >
                                        Cancelar Matrícula
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </PageLayout>
    );
};

export default EnrollmentsPage;