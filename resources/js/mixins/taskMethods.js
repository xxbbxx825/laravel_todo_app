export const taskMethods = {
  methods: {
    getTask(id) {
      axios.get("/api/tasks/" + id).then((res) => {
        this.task = res.data;
      });
    },
    getSubTasks(id) {
      axios.get("/api/tasks/" + id + "/sub_tasks").then((res) => {
        this.sub_tasks = res.data;
      });
    },
    deleteTask(id) {
      axios.delete("/api/tasks/" + id).then(() => {
        this.$router.push({ name: "task.list" });
      });
    },
    deleteSubTask(id) {
      axios.delete("/api/sub_tasks/" + id).then(() => {
        this.$router.push({ name: "task.show" });
      });
    },
  },
};
