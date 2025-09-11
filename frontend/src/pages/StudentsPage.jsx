import React, { useState, useEffect } from 'react';
import PageLayout from '../components/PageLayout';
import { Link } from 'react-router-dom';

const StudentsPage = () => {
    const [students, setStudents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [searchTerm, setSearchTerm] = useState('');

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

    const handleSearchChange = (e) => {
        setSearchTerm(e.target.value);
    };

    const handleClearSearch = () => {
        setSearchTerm('');
    };

    const handleDelete = async (studentId) => {
        if (!window.confirm('Tem certeza que deseja excluir este aluno?')) {
            return;
        }

        try {
            const token = localStorage.getItem('token');
            const response = await fetch(`http://localhost:8000/api/students/${studentId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                throw new Error('Falha ao excluir o aluno.');
            }

            // Remove o aluno da lista na tela após a exclusão bem-sucedida
            setStudents(students.filter(student => student.id !== studentId));
        } catch (err) {
            setError(err.message);
        }
    };


    if (loading) return <PageLayout pageTitle="Gerenciamento de Alunos"><div>Carregando...</div></PageLayout>;
    if (error) return <PageLayout pageTitle="Gerenciamento de Alunos"><div>Erro: {error}</div></PageLayout>;

    return (
        <PageLayout pageTitle="Gerenciamento de Alunos">
            <div className="container">
                <h1>Gerenciamento de Alunos</h1>
                <Link to="/students/create" className="btn btn-primary">Novo Aluno</Link>
                <div className="search-form">
                    <input 
                        type="text" 
                        placeholder="Pesquisar por nome ou e-mail..."
                        value={searchTerm}
                        onChange={handleSearchChange}
                    />
                    <button onClick={handleClearSearch} className="btn btn-link">Limpar</button>
                </div>
                <table className="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {students.map(student => (
                            <tr key={student.id}>
                                <td>{student.id}</td>
                                <td>{student.name}</td>
                                <td>{student.email}</td>
                                <td className="actions">
                                    <Link to={`/students/edit/${student.id}`} className="btn btn-secondary">Editar</Link>
                                    <button 
                                        onClick={() => handleDelete(student.id)} 
                                        className="btn btn-danger"
                                    >
                                        Excluir
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

export default StudentsPage;