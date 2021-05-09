<template>
    <app-layout>
        <template #header>
            folder
        </template>
        <jet-action-section>
            <template #title>
                フォルダ一覧
            </template>
            <template #content>
                <div class="flex">
                    <div>
                        <h5>フォルダ</h5>
                        <jet-button>
                            <inertia-link :href="route('folders.create')">フォルダを追加する</inertia-link>
                        </jet-button>
                        <ul>
                            <li v-for="folder in folders" v-bind:key="folder.id">
                                <inertia-link :href="route('task.index', folder.id)">
                                    <div :class="{'current-folder': currentFolderId==folder.id}">{{ folder.title }}</div>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5>タスク</h5>
                        <jet-button>
                            <inertia-link :href="route('task.create', currentId)">タスクを追加する</inertia-link>
                        </jet-button>
                        <table>
                            <thead>
                                <tr>
                                    <th>タイトル</th>
                                    <th>状態</th>
                                    <th>期限</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in tasks" :key="task.id">
                                    <td>{{ task.title }}</td>
                                    <td>{{ task.status }}</td>
                                    <td>{{ task.due_date}}</td>
                                    <td><jet-button><inertia-link :href="route('task.edit', [currentFolderId, task.id])">編集</inertia-link></jet-button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </template>
        </jet-action-section>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetButton from '@/Jetstream/Button'

    export default {
        components: {
            AppLayout,
            JetActionSection,
            JetButton,
        },
        props: {
            folders: Array,
            currentFolderId: Number,
            tasks: Array,
        },
        data() {
            return {
                currentId: this.currentFolderId,
            }
        }
    }
</script>
<style scoped>
.current-folder {
    background-color: aqua;
}

.flex{
    display: flex;
}
</style>