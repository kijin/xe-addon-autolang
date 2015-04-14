
XE 언어 자동 선택 애드온
------------------------

다국어 지원 웹사이트에서 브라우저의 `Accept-Language` 헤더에 따라 언어를 자동으로 선택해 주는 애드온입니다.
직접 설치하실 경우 `./addons/autolang` 경로에 설치하시면 됩니다.

[soo_autolang](https://www.xpressengine.com/index.php?mid=download&package_id=18982196) 애드온을 참고하였으나,
아래와 같은 차이가 있습니다.

  - 언어 감지 방식을 단순화
  - 지원하는 언어 목록을 별도로 나열하지 않고 XE에서 기본 제공하는 설정에 의존
  - 이미 로딩된 모듈의 언어 파일을 다시 로딩하는 루틴을 개선
