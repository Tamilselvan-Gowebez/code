let siteUrl;
if (location.hostname == "localhost") {
  siteUrl =
    location.protocol +
    "//" +
    location.hostname +
    "/RNsights/Specialty-Survey-Results-Screen";
} else {
  siteUrl = location.protocol + "//" + location.hostname + "/speciality-survey";
}

location.href = siteUrl + "/thank-you.php";
