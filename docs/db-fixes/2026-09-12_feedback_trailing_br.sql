-- One-off content fix: strip a stray trailing <br> from the "Brayam Dias"
-- testimonial's Portuguese description. The <br> sat right before the
-- closing </p>, which pushed the CSS-generated closing quote mark onto its
-- own line in the testimonial slider.
--
-- Run the SELECT first to confirm this is the right row on production
-- (ids can differ from the dev DB), then run the UPDATE.

SELECT id, description FROM feedback WHERE id = 8;

UPDATE feedback
SET description = JSON_SET(description, '$.pt', '<p>O trabalho do Daniel é sensacional, um profissional de confiança e que entrou em um momento crucial da minha agencia onde eu estava apertado com prazos, ele resolveu tudo muito rápido e surpreendente muito melhor do que eu esperava, recomendo demais o trabalho dele para todos!</p>')
WHERE id = 8;
