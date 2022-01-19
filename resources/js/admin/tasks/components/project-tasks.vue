<template>
	<div>
        <div class="grid grid-cols-4 gap-4">
            <div v-for="status in statuses">
                <div class="flex flex-row justify-between items-center">
                    <h2 class="text-lg font-medium mt-5 mb-5">{{ status.name }}</h2>
                    <button @click="openNewTask(status.id)" class="btn mr-3 box text-gray-700 dark:text-gray-300 w-10 h-10">
                        <span class="w-5 h-5 flex items-center justify-center"><i class="w-4 h-4" data-feather="plus"></i></span>
                    </button>
                </div>
                <draggable v-model="status.tasks" item-key="id" @change="saveOrder(status.id, $event)" :animation="200" ghost-class="ghost-card" group="tasks" class="project-task-column pr-3 overflow-scroll">
                    <template #item="{element, index}">
                        <task-card :task="element" @click="openUpdateTask(status.id, element.id)" @remove="removeTask(status.id, $event)" :filter="filter"/>
                    </template>
                </draggable>
            </div>
        </div>
        <transition name="fade" mode="out-in">
            <new-task :display="newTaskOpenned" @close="newTaskOpenned = !newTaskOpenned" @add="addTask" :project="project" :assignees="assignees" :statusId="newTaskStatusId"/>
        </transition>
        <transition name="fade" mode="out-in">
            <edit-task v-if="updateTaskOpenned" @close="updateTaskOpenned = !updateTaskOpenned" @update="updateTask" :project="project" :assignees="assignees" :taskId="updateTaskId" :statusId="updateTaskStatusId"/>
        </transition>
    </div>

    <remove-popup @closure="removeTask" >
        <question>Are you sure?</question>
        <text>This action is pernament</text>
    </remove-popup>
</template>

<script>
import Draggable from 'vuedraggable';
import TaskCard from './task-card';
import NewTask from './new-task';
import EditTask from './edit-task';
import RemovePopup from '../components/popups/remove-popup';
import axios from 'axios';

export default {
    data() {
        return {
            newTaskOpenned : false,
            newTaskStatusId : null,
            updateTaskOpenned : false,
            updateTaskStatusId: null,
            updateTaskId : null,
            project: window.projectId,
            statuses : window.statuses,
        }
    },
    methods : {
        openNewTask(statusId) {
            this.newTaskStatusId = statusId;
            this.newTaskOpenned = true;
        },
        openUpdateTask(statusId, taskId) {
            this.updateTaskStatusId = statusId;
            this.updateTaskId = taskId;
            this.updateTaskOpenned = true;
        },
        addTask(data) {
            this.statuses[data.status_id].tasks.unshift(data);
        },
        updateTask(data) {
            this.statuses[data.status_id].tasks = this.statuses[data.status_id].tasks.map(task => {
               return task.id === data.id ? data : task;
            });
        },
        removeTask(status_id, item) {
            axios.post(`/admin/task/${item.id}/delete`).then(response => {
                if (response.status === 200)
                    this.statuses[status_id].tasks = this.statuses[status_id].tasks.filter(t => t.id !== item.id);
            });
        },
        
		saveOrder(status, item) {
		    let moved = null;
		    let previous = null;
		    if (item.added) {
                moved = item.added.element.id;
                previous = item.added.newIndex > 0 ? this.statuses[status].tasks[item.added.newIndex - 1].id : null;
            } else if (item.moved) {
                moved = item.moved.element.id;
                previous = item.moved.newIndex > 0 ? this.statuses[status].tasks[item.moved.newIndex - 1].id : null;
            } else return;
			axios.post(`/admin/tasks/${moved}/update-order`, {
				previous: previous,
                status: status,
			});
		},
	},
    components : {
        draggable : Draggable,
        'task-card' : TaskCard,
        'new-task' : NewTask,
        'edit-task' : EditTask,
        'remove-popup' : RemovePopup,
    },
	props : {
        assignees : [Object, null],
        filter : [String, null],
    }
}
</script>

<style scoped>
.project-task-column {
    height: 80vh;
    min-height: 400px;
}

.column-width {
    min-width: 320px;
    width: 320px;
}
.ghost-card {
    border-radius: 0.5rem;
    opacity: 0.5;
    border: 1px solid #4299e1;
}
</style>
