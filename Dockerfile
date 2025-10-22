# --- Build Stage ---
FROM node:20-alpine AS builder
WORKDIR /app
RUN apk add --no-cache python3 make g++ libc6-compat
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# --- Production Stage ---
FROM nginx:stable-alpine AS production
WORKDIR /usr/share/nginx/html

# ✅ คัดลอกเฉพาะไฟล์ public ที่ build แล้ว
COPY --from=builder /app/.output/public ./

# ✅ กำหนด nginx.conf ให้เสิร์ฟหน้า index.html
RUN echo 'server { \
    listen 80; \
    server_name localhost; \
    root /usr/share/nginx/html; \
    index index.html; \
    location / { \
    try_files $$uri $$uri/ /index.html; \
    } \
    }' > /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
