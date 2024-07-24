import React, {useState} from 'react';

function ColorPicker(){
    const [color, setColor] = useState("#FFFFFF");

    function handleColorChange(event){
        setColor(event.target.value);
    }

    return (
        <div className="color-picker-container">
            <input type="color" value={color} onChange={handleColorChange} />
        </div>
    );
}

export default ColorPicker
