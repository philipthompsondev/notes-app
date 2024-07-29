import React, {useState} from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, Head } from '@inertiajs/react';
import Label from "@/Components/Labels/Label.jsx";

export default function Index({ auth, labels }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        bg_color: '#FFFFFF',
        font_color: '#000000'
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('labels.store'), { onSuccess: () => reset() });
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
            <Head title="Labels"/>
            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <label htmlFor="label">Label Title</label>
                    <input
                        type="text"
                        name="label"
                        placeholder="Note Title"
                        onChange={e => setData('label', e.target.value)}
                        className="w-full mb-2 p-2 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>

                    <div className="grid grid-cols-2">
                        <div className="col-span-1">
                            <label htmlFor="bg_color">Background Color:</label>
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

                    <InputError message={errors.label} className="mt-2"/>
                    <InputError message={errors.bg_color} className="mt-2"/>
                    <InputError message={errors.font_color} className="mt-2"/>
                    <PrimaryButton className="mt-4" disabled={processing}>New Label</PrimaryButton>
                </form>
            </div>

            <div className="grid grid-cols-5 gap-4 mx-10 my-5">
                {labels.map(label =>
                    <Label key={label.id} label={label}/>
                )}
            </div>
        </AuthenticatedLayout>
    );
}
