document.getElementById("eventForm").addEventListener("submit", function (event) {
    event.preventDefault();
  
    const occasion = document.querySelector('input[name="occasion"]:checked')?.value;
    const objective = document.querySelector('input[name="objective"]:checked')?.value;
    const participants = document.getElementById("participants").value;
  
    if (occasion && objective && participants) {
      alert(`Form Submitted:\nOccasion: ${occasion}\nObjective: ${objective}\nParticipants: ${participants}`);
    } else {
      alert("Please fill out all fields before continuing.");
    }
  });
  