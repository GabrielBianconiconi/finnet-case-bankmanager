import React from 'react';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import './PageLayout.css';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBook, faUserGroup, faIdCard, faRightFromBracket } from '@fortawesome/free-solid-svg-icons';

const PageLayout = ({ pageTitle, children }) => {
    const location = useLocation();
    const navigate = useNavigate(); 

    const handleLogout = () => {
        localStorage.removeItem('token');
        navigate('/login');
    };

    return (
        <div className="main-container">
            <aside className="sidebar">
                <div className="sidebar-header">
                    <Link to="/courses" className="logo">BM</Link>
                </div>
                <nav className="sidebar-nav">
                    <Link to="/courses" title="Cursos" className={location.pathname === '/courses' ? 'active' : ''}><FontAwesomeIcon icon={faBook} /></Link>
                    <Link to="/students" title="Alunos" className={location.pathname === '/students' ? 'active' : ''}><FontAwesomeIcon icon={faUserGroup} /></Link>
                    <Link to="/enrollments" title="Matrículas" className={location.pathname === '/enrollments' ? 'active' : ''}><FontAwesomeIcon icon={faIdCard} /></Link>
                </nav>
                <div className="sidebar-footer">
                    <button onClick={handleLogout} title="Sair" className="logout-button">
                        <FontAwesomeIcon icon={faRightFromBracket} />
                    </button>
                </div>
            </aside>

            <main className="main-content">
                <header className="main-header">
                    <h2>{pageTitle || 'Painel'}</h2>
                </header>
                <div className="content-body">
                    {children}
                </div>
            </main>
        </div>
    );
};

export default PageLayout;