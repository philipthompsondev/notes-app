import React, {useState} from 'react';
import Dropdown from "@/Components/Dropdown.jsx";
import {useForm, usePage} from "@inertiajs/react";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Note({ note }) {
    const { auth } = usePage().props;
    const [editing, setEditing] = useState(false);

    const { data, setData, patch, clearErrors, reset, errors } = useForm({
        title: note.title,
        message: note.message,
        bg_color: note.bg_color,
        font_color: note.font_color,
    });

    const submit = (e) => {
        e.preventDefault();
        patch(route('notes.update', note.id), { onSuccess: () => setEditing(false) });
    };

    const [bgColor, setBgColor] = useState(note.bg_color);

    const [fontColor, setFontColor] = useState(note.font_color);

    function handleBgColorChange(event){
        setBgColor(event.target.value);
        setData('bg_color', event.target.value);
    }

    function handleFontColorChange(event){
        setFontColor(event.target.value);
        setData('font_color', event.target.value);
    }

    return (
        <div className="rounded-lg px-2 py-2" style={{backgroundColor: note.bg_color, color: note.font_color}}>
            <div className="grid grid-cols-4">
                <h3 className="col-span-3 font-bold">{note.title}</h3>
                <div className="col-span-1">
                    {note.user.id === auth.user.id &&
                        <Dropdown>
                            <Dropdown.Trigger>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 text-gray-400"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    </svg>
                                </button>
                            </Dropdown.Trigger>
                            <Dropdown.Content>
                                <button
                                    className="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                                    onClick={() => setEditing(true)}>
                                    Edit
                                </button>
                                <Dropdown.Link as="button" href={route('notes.destroy', note.id)} method="delete">
                                    Delete
                                </Dropdown.Link>
                            </Dropdown.Content>
                        </Dropdown>
                    }
                </div>

                {editing
                    ?
                        <div id="default-modal" tabIndex="-1" aria-hidden="true"
                             className="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div className="relative p-4 w-full max-w-2xl max-h-full">
                                <div className="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <form onSubmit={submit}>
                                        <input
                                            type="text"
                                            name="title"
                                            placeholder="Note Title"
                                            value={data.title}
                                            onChange={e => setData('title', e.target.value)}
                                            className="w-full mb-2 p-2 text-gray-900 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>

                                        <textarea
                                            name="message"
                                            placeholder="Write something down."
                                            value={data.message}
                                            onChange={e => setData('message', e.target.value)}
                                            className="w-full h-full p-2 mb-2 text-gray-900 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        ></textarea>

                                        <div className="grid grid-cols-2">
                                            <div className="col-span-1">
                                                <label htmlFor="bg_color" className="text-black">BG Color:</label>
                                                <input name='bg_color'
                                                       id='bg_color'
                                                       type="color"
                                                       value={bgColor}
                                                       onChange={handleBgColorChange}
                                                />
                                            </div>

                                            <div className="col-span-1">
                                                <label htmlFor="font_color" className="text-black">Font Color:</label>
                                                <input name='font_color'
                                                       id='font_color'
                                                       type="color"
                                                       value={fontColor}
                                                       onChange={handleFontColorChange}
                                                />
                                            </div>
                                        </div>

                                        <InputError message={errors.title} className="mt-2"/>
                                        <InputError message={errors.message} className="mt-2"/>
                                        <InputError message={errors.bg_color} className="mt-2"/>
                                        <InputError message={errors.font_color} className="mt-2"/>

                                        <div className="space-x-2">
                                            <PrimaryButton className="mt-4">Save</PrimaryButton>
                                            <button className="mt-4 text-black" onClick={() => {
                                                setEditing(false);
                                                reset();
                                                clearErrors();
                                            }}>Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    :
                        <p className="col-span-4">{note.message}</p>
                }

            </div>
        </div>
    )
        ;
}
