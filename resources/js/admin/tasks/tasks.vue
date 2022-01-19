<template>
    <div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 flex flex-wrap sm:flex-nowrap items-center justify-between mt-2">
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input v-model="filter" type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
            </div>
        </div>
        <project-tasks :assignees="assignees" :filter="filter"/>
    </div>
</template>

<script>
import ProjectTasks from './components/project-tasks';
import NewTask from './components/new-task';

export default {
    data() {
        return {
            newTaskOpenned: false,
            assignees : window.assignees,
            filter : null,
        }
    },
    components: {
        NewTask,
        'project-tasks' : ProjectTasks,
    },
}
</script>
