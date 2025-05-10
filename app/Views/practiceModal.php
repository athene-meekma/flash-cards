<script>
  var card_ids = Object.keys(cards);
  var index = 0;

  const vis = ['hidden', 'visible'];

  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
  }

  function showCard(front, modifier){
    // Get card to display
    index = index + parseInt(modifier ?? 0);
    let thisCard = cards[card_ids[index]];

    // Show/hide navigation button
    $('#previous').css('visibility', vis[Number(index !== 0)]);
    $('#next').css('visibility', vis[Number(index < card_ids.length - 1)]);

    // Display new text
    $('#flash-card-text').text(thisCard[front]);

    // Show sound if it exists and we're showing definition
    let showSound = Boolean(thisCard.sound_clip && front == 'definition');
    $('#sound-clip').toggle(showSound);
    $('#sound-clip').attr('autoplay', showSound);
    $('#sound-clip').attr('src', thisCard.sound_clip);
  }

  $(document).ready(function() {
    var front = localStorage.getItem('front') ?? 'word';

    $('.practice').on('click', function(e){
      front = localStorage.getItem('front') ?? 'word';
      shuffleArray(card_ids);
      $('#practiceTitle').html('Practice <?=$pack['name']?>!');
      showCard(front);
    });

    $('#flip').on('click', function(){
      front = front === 'word' ? 'definition' : 'word';
      showCard(front);
    });

    $('#next, #previous').on('click', function(){
      front = localStorage.getItem('front') ?? 'word';
      showCard(front, $(this).val());
    })
  });
</script>

<div class="modal modal-xl fade" id="practice" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="practiceTitle"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
        <div class="card" style="height: 50vh">
          <div id="flash-card" class="card-body">
            <span id="flash-card-text"></span>
            <audio id="sound-clip" controls></audio>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-info" id="previous" value="-1">
          <i class="fa-solid fa-arrow-left"></i>
        </button>
        <button type="button" class="btn btn-info" id="flip">
          <i class="fa-solid fa-retweet"></i>
        </button>
        <button type="button" class="btn btn-info" id="next" value="1">
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>
