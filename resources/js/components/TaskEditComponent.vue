<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit"  v-if="task[0]">
          <div class="form-group row">
            <label for="id" class="col-sm-3 col-form-label">ID</label>
            <input type="text" class="col-sm-9 form-control-plaintext" readonly id="id" v-model="task[0].id">
          </div>
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <input type="text" class="col-sm-9 form-control" id="title" v-model="task[0].title">
          </div>
          <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <input type="text" class="col-sm-9 form-control" id="status" v-model="task[0].status">
          </div>
          <div class="form-group row">
            <label for="due" class="col-sm-3 col-form-label">Due</label>
            <input
              type="date"
              class="col-sm-9 form-control"
              id="due"
              v-model="task[0].due"
            />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
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
      submit() {
          axios.put('/api/tasks/' + this.taskId, this.task[0])
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
