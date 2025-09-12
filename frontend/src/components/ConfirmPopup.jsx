import React from 'react';
import './ConfirmPopup.css'; 

const ConfirmPopup = ({ message, onConfirm, onCancel }) => {
    return (
        <div className="popup-overlay">
            <div className="popup-content">
                <p>{message}</p>
                <div className="popup-actions">
                    <button onClick={onCancel} className="btn btn-cancel">Cancelar</button>
                    <button onClick={onConfirm} className="btn btn-confirm">Confirmar</button>
                </div>
            </div>
        </div>
    );
};

export default ConfirmPopup;