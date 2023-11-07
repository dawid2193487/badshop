from flask import Flask
import exploits

app = Flask(__name__)

class TestManager:
    targets = [
        "http://php:8000", 
        # "http://nginx:80"
    ]
    tests = [
        exploits.sqli.user_impersonation, 
        # exploits.ssrf.internal_system_access
    ]

    def run(self):
        for target in self.targets:
            for test in self.tests:
                yield (test.__qualname__, target, test(target))

    def run_against(self, target):
        for test in self.tests:
            yield (test.__qualname__, target, test(target))

    # def run_test(self, test):
    #     for target in self.targets:
    #         yield (test.__name__, target, test(target))

@app.route("/")
def hello_world():
    buffer = ""
    
    tests = TestManager()
    results = tests.run()
    for name, target, result in results:
        buffer += f"<p>{name} against {target} -> {result}</p>"
    return buffer

@app.route("/test/<test_id>/<host_id>")
def test(test_id, host_id):
    return f"{test_id} {host_id}"

if __name__ == "__main__":
    app.run(host="0")