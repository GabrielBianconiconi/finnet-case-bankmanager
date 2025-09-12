import React, { useState } from 'react';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import './PageLayout.css';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBook, faUserGroup, faIdCard, faRightFromBracket } from '@fortawesome/free-solid-svg-icons';

const PageLayout = ({ pageTitle, children }) => {
    const location = useLocation();
    const navigate = useNavigate(); 
    const [isHovered, setIsHovered] = useState(false);
    const isActive = (path) => location.pathname.startsWith(path);
    const sidebarClass = `sidebar ${isHovered ? 'extended' : ''}`;
    const handleLogout = () => {
        localStorage.removeItem('token');
        navigate('/login');
    };

    return (
        <div className="main-container">
            <aside 
                className={sidebarClass}
                onMouseEnter={() => setIsHovered(true)}
                onMouseLeave={() => setIsHovered(false)}
            >
                {/* O restante do seu JSX para a sidebar */}
                <div className="sidebar-header">
                    <Link to="/courses" className="logo">BM</Link>
                </div>
                <nav className="sidebar-nav">
                    <Link to="/courses" title="Cursos" className={isActive('/courses') ? 'active' : ''}>
                        <FontAwesomeIcon icon={faBook} />
                        <span className="nav-text">Cursos</span>
                    </Link>
                    <Link to="/students" title="Alunos" className={isActive('/students') ? 'active' : ''}>
                        <FontAwesomeIcon icon={faUserGroup} />
                        <span className="nav-text">Alunos</span>
                    </Link>
                    <Link to="/enrollments" title="Matrículas" className={isActive('/enrollments') ? 'active' : ''}>
                        <FontAwesomeIcon icon={faIdCard} />
                        <span className="nav-text">Matrículas</span>
                    </Link>
                </nav>
                <div className="sidebar-footer">
                    <button onClick={handleLogout} title="Sair" className="btn btn-danger logout-button">
                        <FontAwesomeIcon icon={faRightFromBracket} />
                        <span className="nav-text">Sair</span>
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