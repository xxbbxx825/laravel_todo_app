<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <input type="text" class="col-sm-9 form-control" id="title" v-model="task.title">
          </div>
          <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <input type="text" class="col-sm-9 form-control" id="status" v-model="task.status">
          </div>
          <div class="form-group row">
            <label for="due" class="col-sm-3 col-form-label">Due</label>
            <input type="" class="col-sm-9 form-control" id="due" v-model="task.due">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data: function () {
        return {
            task: {}
        }
    },
    methods: {
        submit() {
            axios.post('/api/tasks', this.task)
                .then((res) => {
                    this.$router.push({name: 'task.list'});
                });
        }
    }
}
</script>
