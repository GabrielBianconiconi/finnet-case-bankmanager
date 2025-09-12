import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import PageLayout from '../components/PageLayout';

const CourseForm = () => {
    const { id } = useParams(); 
    const navigate = useNavigate();
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        if (id) {
            const fetchCourse = async () => {
                try {
                    const token = localStorage.getItem('token');
                    const response = await fetch(`http://localhost:8000/api/courses/${id}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Curso não encontrado.');
                    }

                    const result = await response.json();
                    setTitle(result.data.title);
                    setDescription(result.data.description);
                } catch (err) {
                    setError(err.message);
                }
            };
            fetchCourse();
        }
    }, [id]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError(null);
        
        const method = id ? 'PUT' : 'POST';
        const url = id ? `http://localhost:8000/api/courses/${id}` : 'http://localhost:8000/api/courses';

        try {
            const token = localStorage.getItem('token');
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({ title, description })
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'Erro ao salvar o curso.');
            }
            
            navigate('/courses');

        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };
    
    const pageTitle = id ? 'Editar Curso' : 'Adicionar Novo Curso';

    return (
        <PageLayout pageTitle={pageTitle}>
            <div className="container">
                
                {error && <div className="error-message">{error}</div>}
                
                <form onSubmit={handleSubmit} className="form">
                    <div className="form-group">
                        <label htmlFor="title">Título do Curso</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value={title}
                            onChange={(e) => setTitle(e.target.value)}
                            required
                        />
                        <small>O nome principal do curso. Ex: Biologia Celular.</small>
                    </div>
                    
                    <div className="form-group">
                        <label htmlFor="description">Descrição</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            value={description}
                            onChange={(e) => setDescription(e.target.value)}
                        ></textarea>
                        <small>Uma breve descrição sobre o que será abordado no curso.</small>
                    </div>

                    <div className="form-actions">
                        <button type="submit" className="btn btn-primary" disabled={loading}>
                            {loading ? 'Salvando...' : (id ? 'Atualizar Curso' : 'Salvar Curso')}
                        </button>
                        
                        <a onClick={() => navigate('/courses')} className="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </PageLayout>
    );
};

export default CourseForm;