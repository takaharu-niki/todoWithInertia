<template>
    <app-layout>
        <template #header>
            <h2>add folder</h2>
        </template>
        <jet-form-section @submitted="createFolder">
            <template #title>
                フォルダ追加
            </template>
            <template #description>
                フォルダの追加を行います
            </template>
            <template #form>
                <div>
                    <jet-label for="title" value="フォルダ名" />
                    <jet-input id="title" type="text" v-model="form.title" />
                    <jet-input-error :message="form.errors.title"></jet-input-error>
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
    import JetButton from '@/Jetstream/Button'
    import JetInputError from '@/Jetstream/InputError'

    export default {
        components: {
            AppLayout,
            JetFormSection,
            JetLabel,
            JetInput,
            JetButton,
            JetInputError,
        },
        data() {
            return {
                form: this.$inertia.form ({
                        title: '',
                    },
                )
            };
        },
        methods: {
            createFolder() {
                this.form.post(route('folders.store'))
            }
        }
    }
</script>