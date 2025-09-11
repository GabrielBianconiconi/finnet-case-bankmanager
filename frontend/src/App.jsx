import React from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import LoginPage from './pages/LoginPage';
import EnrollmentsPage from './pages/EnrollmentsPage';
import StudentsPage from './pages/StudentsPage';
import CoursesPage from './pages/CoursesPage';

const PrivateRoute = ({ children }) => {
    const isAuthenticated = !!localStorage.getItem('token');
    return isAuthenticated ? children : <Navigate to="/login" />;
};

const App = () => {
    return (
        <BrowserRouter>
            <Routes>
                {/* Rotas Públicas */}
                <Route path="/login" element={<LoginPage />} />
                <Route path="/" element={<LoginPage />} />

                {/* Rotas Protegidas */}
                <Route path="/enrollments" element={<PrivateRoute><EnrollmentsPage /></PrivateRoute>} />
                <Route path="/students" element={<PrivateRoute><StudentsPage /></PrivateRoute>} />
                <Route path="/courses" element={<PrivateRoute><CoursesPage /></PrivateRoute>} />
                
            </Routes>
        </BrowserRouter>
    );
};

export default App;