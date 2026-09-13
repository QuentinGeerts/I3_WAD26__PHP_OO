<?php

interface Facturable
{
  function getPrixTTC(): float;
  function getLigneFacture(): string;
}
