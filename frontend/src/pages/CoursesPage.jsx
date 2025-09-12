import React, { useState, useEffect } from 'react';
import ConfirmPopup from '../components/ConfirmPopup';
import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTrashAlt } from '@fortawesome/free-solid-svg-icons';
import PageLayout from '../components/PageLayout';

const CoursesPage = () => {
    const [courses, setCourses] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [popupVisible, setPopupVisible] = useState(false);
    const [courseToDeleteId, setCourseToDeleteId] = useState(null);

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

    const handleOpenPopup = (courseId) => {
        setCourseToDeleteId(courseId);
        setPopupVisible(true);
    };

    const handleCancelDelete = () => {
        setPopupVisible(false);
        setCourseToDeleteId(null);
    };

    const handleConfirmDelete = async () => {
        try {
            const token = localStorage.getItem('token');
            await axios.delete(`http://localhost:8000/api/courses/${courseToDeleteId}`, {
                headers: { 'Authorization': `Bearer ${token}` }
            });

            // Atualiza a lista removendo o curso excluído
            setCourses(courses.filter(course => course.id !== courseToDeleteId));
            
            // Fecha o pop-up e limpa o ID
            handleCancelDelete();
        } catch (error) {
            console.error('Erro ao excluir curso:', error);
            alert('Erro ao excluir o curso. Tente novamente.');
            handleCancelDelete();
        }
    };

    if (loading) return <PageLayout pageTitle="Gerenciamento de Cursos"><div>Carregando...</div></PageLayout>;
    if (error) return <PageLayout pageTitle="Gerenciamento de Cursos"><div>Erro: {error}</div></PageLayout>;

    return (
        <PageLayout pageTitle="Bank Manager">
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
                                    <a href={`/courses/edit/${course.id}`} className="btn btn-secondary">Editar</a>
                                    <button 
                                        onClick={() => handleOpenPopup(course.id)} 
                                        className="btn btn-danger"
                                    >
                                        <FontAwesomeIcon icon={faTrashAlt} /> Excluir
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>

            {popupVisible && (
                <ConfirmPopup 
                    message="Tem certeza que deseja excluir este curso?" 
                    onConfirm={handleConfirmDelete} 
                    onCancel={handleCancelDelete} 
                />
            )}
        </PageLayout>
    );
};

export default CoursesPage;