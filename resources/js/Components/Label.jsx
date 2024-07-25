import React from 'react';

export default function Label({ label }) {
    return (
        <div className="rounded-lg px-2 py-2" style={{backgroundColor: label.bg_color, color: label.font_color}}>
            <div className="flex">
                <h3 className="w-5/6 font-bold">{label.label}</h3>
            </div>
        </div>
    );
}
