import React, { useState, useEffect } from 'react';
import ConfirmPopup from '../components/ConfirmPopup';
import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTrashAlt, faSearch } from '@fortawesome/free-solid-svg-icons';
import PageLayout from '../components/PageLayout';
import { Link } from 'react-router-dom';

const StudentsPage = () => {
    const [students, setStudents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [searchTerm, setSearchTerm] = useState('');
    const [popupVisible, setPopupVisible] = useState(false);
    const [studentToDeleteId, setStudentToDeleteId] = useState(null);

    useEffect(() => {
        const fetchStudents = async () => {
            try {
                const token = localStorage.getItem('token');
                const response = await fetch(`http://localhost:8000/api/students?search=${searchTerm}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Falha ao buscar os alunos.');
                }

                const result = await response.json();
                setStudents(result.data);
            } catch (err) {
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchStudents();
    }, [searchTerm]); 

    const handleOpenPopup = (courseId) => {
        setStudentToDeleteId(courseId);
        setPopupVisible(true);
    };

    const handleCancelDelete = () => {
        setPopupVisible(false);
        setStudentToDeleteId(null);
    };


    const handleConfirmDelete = async () => {
        try {
            const token = localStorage.getItem('token');
            await axios.delete(`http://localhost:8000/api/students/${studentToDeleteId}`, {
                headers: { 'Authorization': `Bearer ${token}` }
            });

            // Atualiza a lista removendo o student excluído
            setStudents(students.filter(student => student.id !== studentToDeleteId));
            
            // Fecha o pop-up e limpa o ID
            handleCancelDelete();
        } catch (error) {
            console.error('Erro ao excluir o aluno:', error);
            alert('Erro ao excluir o aluno. Tente novamente.');
            handleCancelDelete();
        }
    };

    

    if (loading) return <PageLayout pageTitle="Gerenciamento de Alunos"><div>Carregando...</div></PageLayout>;
    if (error) return <PageLayout pageTitle="Gerenciamento de Alunos"><div>Erro: {error}</div></PageLayout>;

    return (
        <PageLayout pageTitle="Bank Manager">
            <div className="container">
                <h1>Gerenciamento de Alunos</h1>
                <div className= "toolbar">
                <Link to="/students/create" className="btn btn-primary">Novo Aluno</Link>
                <div className="search-box">
                        <FontAwesomeIcon icon={faSearch} className="search-icon" />
                        <input 
                            type="text" 
                            placeholder="Pesquisar..."
                            className="search-input"
                            value={searchTerm}
                            onChange={e => setSearchTerm(e.target.value)}
                        />
                </div>
            </div>
                
                <table className="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de nascimento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {students.map(student => (
                            <tr key={student.id}>
                                <td>{student.id}</td>
                                <td>{student.name}</td>
                                <td>{student.email}</td>
                                <td>{student.birth_date}</td>
                                <td className="actions">
                                    <a href={`/students/edit/${student.id}`} className="btn btn-secondary">Editar</a>
                                    <button 
                                        onClick={() => handleOpenPopup(student.id)} 
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
                    message="Tem certeza que deseja excluir este aluno?" 
                    onConfirm={handleConfirmDelete} 
                    onCancel={handleCancelDelete} 
                />
            )}
        </PageLayout>
    );
};

export default StudentsPage;