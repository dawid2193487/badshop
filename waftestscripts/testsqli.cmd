docker run --rm --network="host" -v reports:/app/reports -v sqli:/app/testcases wallarm/gotestwaf --url=http://localhost/ --noEmailReport --reportFormat=none
