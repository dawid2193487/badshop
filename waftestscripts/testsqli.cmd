docker run --rm --network="host" -v ${PWD}/reports:/app/reports -v ${PWD}/sqli:/app/testcases wallarm/gotestwaf --url=http://localhost/ --noEmailReport --reportFormat=none
