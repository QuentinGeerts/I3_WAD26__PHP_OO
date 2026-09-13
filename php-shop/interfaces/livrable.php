<?php

interface Livrable
{
  function getFraisLivraison(): float;
  function getDelaiJours(): int;
}
