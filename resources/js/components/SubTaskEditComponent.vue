<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit" v-if="subTask[0]">
          <div class="form-group row">
            <label for="id" class="col-sm-3 col-form-label">ID</label>
            <input
              type="text"
              class="col-sm-9 form-control-plaintext"
              readonly
              id="id"
              v-model="subTask[0].id"
            />
          </div>
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="title"
              v-model="subTask[0].title"
            />
          </div>
          <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="status"
              v-model="subTask[0].status"
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
    subTaskId: {
      type: Number,
      require: true,
    },
    taskId: {
      type: Number,
      require: true,
    },
  },
  data: function () {
    return {
      subTask: {},
    };
  },
  methods: {
    getSubTask() {
      axios.get("/api/sub_tasks/" + this.subTaskId).then((res) => {
        this.subTask = res.data;
      });
    },
    submit() {
      axios
        .put("/api/sub_tasks/" + this.subTaskId, this.subTask[0])
        .then((res) => {
          this.$router.push('/tasks/' + this.taskId, {params: {taskId: this.taskId}});
        });
    },
  },
  mounted() {
    this.getSubTask();
  },
};
</script>
