<template>
  <div class="container">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col"></th>
          <th scope="col">Title</th>
          <th scope="col">Status</th>
          <th scope="col">Due</th>
          <th scope="col">Show</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task in tasks" :key="task.id">
          <th scope="row"></th>
          <td>{{ task.title }}</td>
          <td>{{ task.status }}</td>
          <td>{{ task.due }}</td>
          <td>
            <router-link
              :to="{ name: 'task.show', params: { taskId: task.id } }"
            >
              <button class="btn btn-primary">Show</button>
            </router-link>
          </td>
          <td>
            <router-link
              :to="{ name: 'task.edit', params: { taskId: task.id } }"
            >
              <button class="btn btn-success">Edit</button>
            </router-link>
          </td>
          <td>
            <button class="btn btn-danger" @click="deleteTask(task.id)">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { taskMethods } from "../mixins/taskMethods";
export default {
  mixins: [taskMethods],
  data() {
    return {
      tasks: [],
    };
  },
  methods: {
    getTasks() {
      axios
        .get("/api/tasks", {
          headers: {
            Authorization: "Bearer " + this.$store.getters.accessToken,
          },
        })
        .then((res) => {
          this.tasks = res.data;
        })
        .catch((error) => {
          alert("エラー");
        });
    },
  },
  created() {
    this.getTasks();
  },
};
</script>
