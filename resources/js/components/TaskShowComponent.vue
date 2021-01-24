<template>
  <div class="container">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Status</th>
          <th scope="col">Due</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <span>Main task</span>
      <tbody v-if="task">
        <tr>
          <th scope="row"></th>
          <td>{{ task.title }}</td>
          <td>{{ task.status }}</td>
          <td>{{ task.due }}</td>
          <td>
            <router-link
              v-bind:to="{ name: 'task.edit', params: { taskId: task.id } }"
            >
              <button class="btn btn-success">Edit</button>
            </router-link>
          </td>
          <td>
            <button class="btn btn-danger" v-on:click="deleteTask(task.id)">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
      <span>Sub task</span>
      <tbody v-if="sub_tasks">
        <tr v-for="sub_task in sub_tasks" :key="sub_task.id">
          <th scope="row"></th>
          <td>{{ sub_task.title }}</td>
          <td>{{ sub_task.status }}</td>
          <td>{{ sub_task.due }}</td>
          <td>
            <router-link
              v-bind:to="{ name: 'sub_task.edit', params: { taskId: task.id, subTaskId: sub_task.id } }"
            >
              <button class="btn btn-success">Edit</button>
            </router-link>
          </td>
          <td>
            <button
              class="btn btn-danger"
              v-on:click="deleteSubTask(sub_task.id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    taskId: {
      type: Number,
      require: true,
    },
  },
  data () {
    return {
      task: [],
      sub_tasks: [],
      componentKey: 0,
    };
  },
  methods: {
    getTask() {
      axios.get("/api/tasks/" + this.taskId).then((res) => {
        this.task = res.data;
      });
    },
    getSubTasks() {
      axios.get("/api/tasks/" + this.taskId + "/sub_tasks").then((res) => {
        this.sub_tasks = res.data;
      });
    },
    deleteTask(id) {
      axios.delete("/api/tasks/" + id).then((res) => {
        this.$router.push({ name: "task.list" });
      });
    },
    deleteSubTask(subTaskId) {
      axios.delete("/api/sub_tasks/" + subTaskId).then((res) => {
        this.getSubTasks()
      });
    },
  },
  mounted() {
    this.getTask(),
    this.getSubTasks();
  },
};
</script>
