<template>
    <app-layout>
        <template #header>
            Edit
        </template>
        <jet-form-section @submitted="editTask">
            <template #title>
                タスクを編集する
            </template>
            <template #form>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="title">タイトル</jet-label>
                    <jet-input id="title" type="text" v-model="form.title"></jet-input>
                    <jet-input-error :message="form.errors.title"></jet-input-error>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="status">状態</jet-label>
                    <select id="status" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="rawTask.status" @change="onChange">
                        <option v-for="status in statusType" :key="status.number" :value="status.number">
                            {{status.label}}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.status"></jet-input-error>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="due_date">期限</jet-label>
                    <jet-input id="due_date" type="date" v-model="form.due_date"></jet-input>
                    <jet-input-error :message="form.errors.due_date"></jet-input-error>
                </div>
            </template>
            <template #actions>
                <jet-button>
                    送信
                </jet-button>
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
            task: Object,
            rawTask: Object,
            statusType: Object,
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
                form: this.$inertia.form(
                    {
                        title: this.task.title,
                        status: this.rawTask.status,
                        due_date: this.task.due_date,                    
                    },
                    {
                        bag: 'EditTask'
                    }
                )
            }
        },
        methods: {
            onChange(e) {
                this.form.status = e.target.value;
            },
            editTask() {
                this.form.patch(route('task.update', [this.task.folders_id, this.task.id]));
            }
        }

    }
</script>