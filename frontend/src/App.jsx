import React from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import LoginPage from './pages/LoginPage';
import StudentsPage from './pages/StudentsPage';
import CoursesPage from './pages/CoursesPage';
import EnrollmentPage from './pages/EnrollmentsPage';
import CourseForm from './pages/CourseForm';
import StudentForm from './pages/StudentForm';
import EnrollmentForm from './pages/EnrollmentForm';

import './styles/Forms.css';

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
                <Route path="/logout" element={<LoginPage />} />

                {/* Rotas Protegidas */}
                <Route path="/courses" element={<PrivateRoute><CoursesPage /></PrivateRoute>} />
                <Route path="/courses/create" element={<PrivateRoute><CourseForm /></PrivateRoute>} />
                <Route path="/courses/edit/:id" element={<PrivateRoute><CourseForm /></PrivateRoute>} />

                <Route path="/students" element={<PrivateRoute><StudentsPage /></PrivateRoute>} />
                <Route path="/students/create" element={<PrivateRoute><StudentForm /></PrivateRoute>} />
                <Route path="/students/edit/:id" element={<PrivateRoute><StudentForm /></PrivateRoute>} />

                <Route path="/enrollments" element={<PrivateRoute><EnrollmentPage /></PrivateRoute>} />
                <Route path="/enrollments/create" element={<PrivateRoute><EnrollmentForm /></PrivateRoute>} />
                <Route path="/enrollments/edit/:id" element={<PrivateRoute><EnrollmentForm /></PrivateRoute>} />
                
            </Routes>
        </BrowserRouter>
    );
};

export default App;