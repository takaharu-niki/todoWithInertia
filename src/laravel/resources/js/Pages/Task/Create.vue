<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                create task
            </h2>
        </template>
        <jet-form-section @submitted="createTask">
            <template #form>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="title" value="タイトル" />
                    <jet-input id="title" type="text" v-model="form.title" />
                    <jet-input-error :message="form.errors.title" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="due_date" value="期限" />
                    <jet-input id="due_date" type="date" v-model="form.due_date" />
                    <jet-input-error :message="form.errors.due_date" />
                </div>
            </template>
            <template #actions>
                <jet-button>送信</jet-button>
            </template>
        </jet-form-section>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetLabel from '@/Jetstream/Label'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetButton from '@/Jetstream/Button'

    export default {
        props: {
            folderId: Number,
        },
        components: {
            AppLayout,
            JetFormSection,
            JetLabel,
            JetInput,
            JetInputError,
            JetButton,
        },
        data() {
            return {
                form: this.$inertia.form({
                    title: '',
                    due_date: '',
                    folderId: this.folderId,
                }) 
            }
        },
        methods: {
            createTask() {
                this.form.post(route('task.store', this.folderId))
            }
        }
    }
</script>
