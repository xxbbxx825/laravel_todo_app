<template>
  <div class="container">
    <!-- <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="title"
              v-model="task.title"
            />
          </div>

          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-3 pt-0">Stutas</legend>
              <div class="col-sm-9">
                <div class="form-check">
                  <input
                    type="radio"
                    class="form-check-input"
                    id="status0"
                    value="0"
                    v-model="task.status"
                  />
                  <label for="status0" class="form-check-label">未了</label>
                </div>
                <div class="form-check">
                  <input
                    type="radio"
                    class="form-check-input"
                    id="status1"
                    value="1"
                    v-model="task.status"
                  />
                  <label for="status1" class="form-check-label">進行中</label>
                </div>
                <div class="form-check">
                  <input
                    type="radio"
                    class="form-check-input"
                    id="status2"
                    value="2"
                    v-model="task.status"
                  />
                  <label for="status2" class="form-check-label">完了</label>
                </div>
              </div>
            </div>
          </fieldset>

          <div class="form-group row">
            <label for="due" class="col-sm-3 col-form-label">Due</label>
            <input
              type="date"
              class="col-sm-9 form-control"
              id="due"
              v-model="task.due"
            />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div> -->
  </div>
</template>

<script>
// export default {
//   data: function () {
//     return {
//       task: {},
//     };
//   },
//   methods: {
//     submit() {
//       axios.post("/api/tasks", this.task).then((res) => {
//         this.$router.push({ name: "task.list" });
//       });
//     },
//   },
// };
</script>
