#!/bin/bash

timeout=30
if [ -z "$*" ]; then
  echo "Usage: indexer.sh <url> <full_path_to_outputfile> <full_path_to_verboselog> <cache_path> <wait_time_in_seconds_between_requests>"
  exit 0
fi

url=$1
urlfile=$2
verboselog=$3
cachepath=$4
waittime=$5

#pgrep sproxy &>/dev/null && exit 1

pkill -9 sproxy

cd $cachepath
/usr/local/bin/sproxy -o $urlfile &>/dev/null &
sleep 2
sproxy_pid=$!

#start=$(date "+%s")

#while :; do 
#  lsof -s -p ${sproxy_pid} | grep LISTEN &>/dev/null && break
#  [[ $(( $(date "+%s") - ${start} )) -ge ${timeout} ]] && exit 2
#  sleep 1
#done

wget -nv -r -o $verboselog -l 0 -t 1 --spider -w $waittime -e robots=off -e "http_proxy = http://127.0.0.1:9001" $url

kill -9 ${sproxy_pid} &>/dev/null

sort -u -o $urlfile $urlfile
wait
