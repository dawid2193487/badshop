FROM python:3.11

WORKDIR /code/
COPY ./requirements.txt /code/
RUN pip install -r ./requirements.txt

COPY ./ /code/
CMD [ "python", "-m", "debugpy", "--listen", "0:5678", "-m", "flask", "run", "-h", "0"]