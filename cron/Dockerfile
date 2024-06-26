FROM alpine:latest

# 更新
RUN apk update

# 複製 crontab 文件到容器中
COPY cron/crontab /etc/cron/crontab

# 啟動 cron 服務
CMD ["crond", "-f"]