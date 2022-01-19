<template>
  <transition name="fade" mode="out-in">
      <div v-if="!filter || contains" class="mb-4">
          <div class="grid-cols-12 shadow-xl p-3 gap-y-2 bg-dark-3 rounded-lg">
              <div class="col-span-12 flex justify-between">
                  <div>
                      <a class="font-medium cursor-pointer">{{ task.name }}</a>
                      <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5"></div>
                  </div>
                  <div class="flex-shrink-0 text-right">
                      <div class="text-primary-4 text-md whitespace-nowrap mt-2 cursor-pointer">{{ deadline }}</div>
                      <div class="text-center mt-1 cursor-pointer"><i data-feather="clock" class="w-3 h-3"></i> {{ duration }}</div>
                  </div>
              </div>
              <div class="col-span-12 mt-3">
                  <div class="flex flex-row justify-between">
                      <div class="w-24 flex table-report ml-5 h-10">
                          <div v-for="assignee in task.assignees" class="w-10 h-10 image-fit zoom-in -ml-5">
                              <img class="tooltip rounded-full" :src="assignee.avatar_path" :title="assignee.full_name">
                          </div>
                      </div>
                      <div class="flex items-end">
                          <button class="flex items-center text-primary-3 zoom-in focus:outline-none remove-task" @click.stop="$emit('remove', task)">
                              Remove&nbsp;&nbsp;<i data-feather="x" class="w-4 h-4"></i>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </transition>
</template>
<script>
import moment from 'moment';

export default {
    computed: {
        contains() {
            return (this.task.name + this.task.description).toLowerCase().includes(this.filter.toLowerCase());
        },
        deadline() {
            return moment(this.task.deadline).format('DD.MM.YYYY');
        },
        duration() {
            const duration = moment.duration(this.task.formatted_duration);
            return `${this.formatTime(duration.asHours())}h : ${this.formatTime(duration.minutes())}m`;
        },
    },
    methods: {
        formatTime(time) {
            return Math.floor(time).toString().padStart(2, '0');
        }
    },
    props: {
        task: Object,
        filter: [String, null],
    },
    emits: ['remove']
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.33s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
.fade-enter-to, .fade-leave-from {
    opacity: 1;
}
</style>
