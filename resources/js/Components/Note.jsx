import React from 'react';

export default function Note({ note }) {
    return (
        <div className="rounded-lg px-2 py-2">
            <div className="flex">
                <h3 className="w-5/6 font-bold">{note.title}</h3>
                <p>{note.message}</p>
            </div>
        </div>
    );
}
