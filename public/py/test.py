import sys
import yt_dlp


def my_hook(d):
    if d['status'] == 'finished':
        print('Done downloading, now converting')


def main():
    try:
        url = sys.argv[1]
    except:
        sys.exit('Usage: python thisfile.py URL')

    if url:
        ydl_opts = {
            'format': 'bestaudio/best',
            'outtmpl': 'output/%(title)s' + '.mp3',
            'noplaylist': True,
            'progress_hooks': [my_hook],
        }

        with yt_dlp.YoutubeDL(ydl_opts) as ydl:
            meta = ydl.extract_info(url, download=False)
            # ydl.download([url])

        title = meta['title']
        duration = meta['duration'] / 60
        data = {
            'title': title,
            'duration': duration,
            'file': title + '.mp3'
        }
        print(data)

if __name__ == '__main__':
    main()
