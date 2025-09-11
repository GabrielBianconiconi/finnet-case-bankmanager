import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import './PageLayout.css'; // You'll create this file
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBook, faUserGroup, faIdCard, faRightFromBracket } from '@fortawesome/free-solid-svg-icons';

const PageLayout = ({ pageTitle, children }) => {
    const location = useLocation();

    return (
        <div className="main-container">
            {/* Sidebar */}
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
                    <Link to="/logout" title="Sair"><FontAwesomeIcon icon={faRightFromBracket} /></Link>
                </div>
            </aside>

            {/* Main Content */}
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