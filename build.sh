docker build -t dummy-ussd .
docker tag dummy-ussd:latest registry.netcengroup.com/dummy-ussd:latest
docker push registry.netcengroup.com/dummy-ussd:latest
