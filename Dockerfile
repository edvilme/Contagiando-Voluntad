FROM php:latest
# copy files
COPY . .
# run
CMD php hello.php