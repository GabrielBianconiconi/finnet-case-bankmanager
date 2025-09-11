import React, { useState, useEffect } from 'react';
import PageLayout from '../components/PageLayout';

const CoursesPage = () => {
    const [courses, setCourses] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchCourses = async () => {
            try {
                const token = localStorage.getItem('token');
                const response = await fetch('http://localhost:8000/api/courses', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Falha ao buscar os cursos.');
                }

                const result = await response.json();
                setCourses(result.data);
            } catch (err) {
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchCourses();
    }, []);

    if (loading) return <PageLayout pageTitle="Gerenciamento de Cursos"><div>Carregando...</div></PageLayout>;
    if (error) return <PageLayout pageTitle="Gerenciamento de Cursos"><div>Erro: {error}</div></PageLayout>;

    return (
        <PageLayout pageTitle="Gerenciamento de Cursos">
            <div className="container">
                <h1>Gerenciamento de Cursos</h1>
                <a href="/courses/create" className="btn btn-primary">Novo Curso</a>

                <table className="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {courses.map(course => (
                            <tr key={course.id}>
                                <td>{course.id}</td>
                                <td>{course.title}</td>
                                <td>{course.description}</td>
                                <td className="actions">
                                    {}
                                    <a href={`/courses/edit/${course.id}`} className="btn btn-secondary">Editar</a>
                                    <form style={{ display: 'inline' }}>
                                        <button type="submit" className="btn btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </PageLayout>
    );
};

export default CoursesPage;