RUN apt-get update && curl -sL https://deb.nodesource.com/setup_14.x |  bash - && apt install nodejs -y && apt install git -y && apt install -y vim
RUN npm install -g grunt-cli
