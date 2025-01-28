from locust import HttpUser, task

class CapacityTestUser(HttpUser):
    @task
    def get_home(self):
        self.client.get("/api/bands")  

    @task
    def post_data(self):
        self.client.post("/api/generate_labels", json={"name": "value"})