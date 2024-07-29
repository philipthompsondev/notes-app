import React, {useState} from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, Head } from '@inertiajs/react';
import Note from '@/Components/Note';

export default function Index({ auth, notes }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        bg_color: '#FFFFFF',
        font_color: '#000000'
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('notes.store'), { onSuccess: () => reset() });
    };

    const [bgColor, setBgColor] = useState("#FFFFFF");

    const [fontColor, setFontColor] = useState("#000000");

    function handleBgColorChange(event){
        setBgColor(event.target.value);
        setData('bg_color', event.target.value);
    }

    function handleFontColorChange(event){
        setFontColor(event.target.value);
        setData('font_color', event.target.value);
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Notes"/>

            <div className="grid grid-cols-5 gap-4 mx-10 my-5">
                <div className="col-span-2 row-span-2 bg-slate-200 rounded-lg px-2 py-2">
                    <form onSubmit={submit}>
                        <input
                            type="text"
                            name="title"
                            placeholder="Note Title"
                            onChange={e => setData('title', e.target.value)}
                            onSubmit={e => setData('title', e.target.value)}
                            className="w-full mb-2 p-2 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>

                        <textarea
                            name="message"
                            placeholder="Write something down."
                            onChange={e => setData('message', e.target.value)}
                            className="w-full h-full p-2 mb-2 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        ></textarea>

                        <div className="grid grid-cols-2">
                            <div className="col-span-1">
                                <label htmlFor="bg_color">BG Color:</label>
                                <input name='bg_color'
                                       id='bg_color'
                                       type="color"
                                       value={bgColor}
                                       onChange={handleBgColorChange}
                                />
                            </div>

                            <div className="col-span-1">
                                <label htmlFor="font_color">Font Color:</label>
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

                        <PrimaryButton className="mt-4" disabled={processing}>New Note</PrimaryButton>
                    </form>
                </div>


                {notes.map(note =>
                    <Note key={note.id} note={note}/>
                )}
            </div>
        </AuthenticatedLayout>
    );
}
