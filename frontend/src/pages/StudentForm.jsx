import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import PageLayout from '../components/PageLayout';

const StudentForm = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [birthdate, setBirthdate] = useState('');
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        if (id) {
            const fetchStudent = async () => {
                try {
                    const token = localStorage.getItem('token');
                    const response = await fetch(`http://localhost:8000/api/students/${id}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Aluno não encontrado.');
                    }

                    const result = await response.json();
                    setName(result.data.name);
                    setEmail(result.data.email);
                    setBirthdate(result.data.birthdate);
                } catch (err) {
                    setError(err.message);
                }
            };
            fetchStudent();
        }
    }, [id]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError(null);
        
        const method = id ? 'PUT' : 'POST';
        const url = id ? `http://localhost:8000/api/students/${id}` : 'http://localhost:8000/api/students';

        try {
            const token = localStorage.getItem('token');
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({ name, email, birthdate })
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'Erro ao salvar o aluno.');
            }
            
            navigate('/students');

        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };
    
    const pageTitle = id ? 'Editar Aluno' : 'Adicionar Novo Aluno';

    return (
        <PageLayout pageTitle={pageTitle}>
            <div className="container">
                
                {error && <div className="error-message">{error}</div>}
                
                <form onSubmit={handleSubmit} className="form">
                    <div className="form-group">
                        <label htmlFor="name">Nome do Aluno</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                            required
                        />
                    </div>
                    
                    <div className="form-group">
                        <label htmlFor="email">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                        />
                    </div>

                    <div className="form-group">
                        <label htmlFor="birthdate">Data de Nascimento</label>
                        <input
                            type="date"
                            id="birthdate"
                            name="birthdate"
                            value={birthdate}
                            onChange={(e) => setBirthdate(e.target.value)}
                        />
                    </div>

                    <div className="form-actions">
                        <button type="submit" className="btn btn-primary" disabled={loading}>
                            {loading ? 'Salvando...' : (id ? 'Atualizar Aluno' : 'Salvar Aluno')}
                        </button>
                        
                        <a onClick={() => navigate('/students')} className="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </PageLayout>
    );
};

export default StudentForm;