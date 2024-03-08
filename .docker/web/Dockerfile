FROM node:17.9.0 AS npm-install-stage
WORKDIR /usr/src/app
COPY . ./

RUN npm ci && npm run build

FROM nginx:1.23-alpine
COPY --chown=nginx:nginx . /var/www/
WORKDIR /var/www/

COPY --from=npm-install-stage /usr/src/app/public/build /var/www/public/build

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
