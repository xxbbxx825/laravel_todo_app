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
      <tbody v-if="task[0]">
        <tr>
          <th scope="row">{{ task[0].id }}</th>
          <td>{{ task[0].title }}</td>
          <td>{{ task[0].status }}</td>
          <td>{{ task[0].due }}</td>
          <td>
            <router-link
              v-bind:to="{ name: 'task.edit', params: { taskId: task[0].id } }"
            >
              <button class="btn btn-success">Edit</button>
            </router-link>
          </td>
          <td>
            <button class="btn btn-danger" v-on:click="deleteTask(task[0].id)">Delete</button>
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
      require: true
    },
  },
  data: function () {
      return {
          task: {}
      }
  },
  methods: {
      getTask() {
          axios.get('/api/tasks/' + this.taskId)
              .then((res) => {
                  this.task = res.data;
              });
      },
      deleteTask(id) {
        axios.delete('/api/tasks/' + id)
            .then((res) => {
                this.$router.push({name: 'task.list'})
            });
    }
  },
  mounted() {
      this.getTask();
  }
};
</script>
