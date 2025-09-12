import React, { useState, useEffect } from 'react';
import ConfirmPopup from '../components/ConfirmPopup';
import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTrashAlt } from '@fortawesome/free-solid-svg-icons';
import PageLayout from '../components/PageLayout';
import { Link } from 'react-router-dom';

const EnrollmentsPage = () => {
    const [enrollments, setEnrollments] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [popupVisible, setPopupVisible] = useState(false);
    const [enrollmentToDeleteId, setEnrollmentToDeleteId] = useState(null);

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

    const handleDelete = async () => {
        try {
            const token = localStorage.getItem('token');
            const response = await axios.delete(`http://localhost:8000/api/enrollments/${enrollmentToDeleteId}`, {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            
            if (response.status === 200) {
                setEnrollments(enrollments.filter(enrollment => enrollment.id !== enrollmentToDeleteId));
            } else {
                 throw new Error('Falha na exclusão da matrícula.');
            }
            
            handleCancelDelete();
        } catch (error) {
            console.error('Erro ao excluir matrícula:', error);
            setError('Erro ao excluir a matrícula. Tente novamente.');
            handleCancelDelete();
        }
    };

    const handleCancelDelete = () => {
        setPopupVisible(false);
        setEnrollmentToDeleteId(null);
    };

    const handleOpenPopup = (enrollmentId) => {
        setEnrollmentToDeleteId(enrollmentId);
        setPopupVisible(true);
    };

    if (loading) return <PageLayout pageTitle="Gerenciamento de Matrículas"><div>Carregando...</div></PageLayout>;
    if (error) return <PageLayout pageTitle="Gerenciamento de Matrículas"><div>Erro: {error}</div></PageLayout>;

    return (
        <PageLayout pageTitle="Bank Manager">
            <div className="container">
                <h1>Gerenciamento de Matrículas</h1>
                <Link to="/enrollments/create" className="btn btn-primary">Nova Matrícula</Link>

                {error && <div className="error-message">{error}</div>}
                
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
                                <td className="actions">
                                    <a href={`/enrollments/edit/${enrollment.id}`} className="btn btn-secondary">Editar</a>
                                    <button 
                                        onClick={() => handleOpenPopup(enrollment.id)} 
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
                    message="Tem certeza que deseja excluir esta matrícula?" 
                    onConfirm={handleDelete} 
                    onCancel={handleCancelDelete} 
                />
            )}
        </PageLayout>
    );
};

export default EnrollmentsPage;