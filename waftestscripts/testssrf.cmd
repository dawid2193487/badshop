docker run --rm --network="host" -v reports:/app/reports -v ssrf:/app/testcases wallarm/gotestwaf --url=http://localhost/ --noEmailReport --reportFormat=none
