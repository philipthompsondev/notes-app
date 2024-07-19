import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, Head } from '@inertiajs/react';

export default function Index({ auth }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        message: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('labels.store'), { onSuccess: () => reset() });
    };

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
                            <input
                                name="bg_color"
                                id="bg_color"
                                type="color"
                                value="#FFFFFF"
                                onChange={e => setData('bg_color', e.target.value)}/>
                        </div>

                        <div className="col-span-1">
                            <label htmlFor="font_color">Font Color:</label>
                            <input
                                name="font_color"
                                id="font_color"
                                type="color"
                                value="#000000"
                                onChange={e => setData('font_color', e.target.value)}/>
                        </div>
                    </div>

                    <InputError message={errors.label} className="mt-2"/>
                    <InputError message={errors.bg_color} className="mt-2"/>
                    <InputError message={errors.font_color} className="mt-2"/>
                    <PrimaryButton className="mt-4" disabled={processing}>New Label</PrimaryButton>
                </form>
            </div>

        </AuthenticatedLayout>
    );
}
